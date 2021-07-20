import React from "react";
import { Button, Container, Form, Modal, Spinner } from "react-bootstrap";
import { create, show, update } from "./Customer.service";

const formStateInit = {
    id: null,
    name: "",
    email: "",
    cpf: '',
    phone: "",
    address: ""
}

export default class CustomerModalForm extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            update: false,
            loading: false,
            validated: false,
            error: null,
            data: {
                ...formStateInit,
            }
        }

        this.handleChange = this.handleChange.bind(this);
        this.handleClose = this.handleClose.bind(this);
        this.setDataState = this.setDataState.bind(this);
        this.onShow = this.onShow.bind(this);
    }

    setDataState(name, value) {
        var newData = {
            ...this.state.data,
            [name]: value
        }
        this.setState({
            data: newData
        })
    }

    handleChange(event) {
        const target = event.target;
        const value = target.type === 'checkbox' ? target.checked : target.value;
        const name = target.name;

        this.setDataState(name, value);
    }

    handleSubmit = async () => {
        this.setState({loading: true});
        this.setState({error: null});
        if (this.props.updateId) {
            await update(this.props.updateId, this.state.data).then(res => {
                this.handleClose()
            }).catch(error => {
                this.setState({error: error.response.data});
            })
        } else {
            await create(this.state.data).then(res => {
                this.handleClose()
            }).catch(error => {
                this.setState({error: error.response.data});
            })

        }
        this.setState({loading: false});
    }

    onShow = async () => {
        if (this.props.updateId) {
            this.setState({loading: true});

            await show(this.props.updateId).then(res => {
                this.setState({data: res})
            });

            this.setState({loading: false});
        }
    }

    handleClose() {
        this.setState({data: formStateInit})
        this.props.handleClose();
    }

    render() {
        return (
            <Form id="formCliente" >
                <Modal
                    show={this.props.show}
                    onShow={this.onShow}
                    onHide={this.handleClose}
                    backdrop="static"
                    keyboard={false}
                    fullscreen='sm-down'
                >
                    <Modal.Header closeButton>
                        {!this.props.updateId && <Modal.Title>Cadastro de Cliente</Modal.Title>}
                        {this.props.updateId && <Modal.Title>Alteração de Cliente</Modal.Title>}
                    </Modal.Header>
                    <Modal.Body>
                        <div className='formErrors'>
                            {this.state.error && Object.keys(this.state.error).map((fieldName, i) => {
                                if (this.state.error[fieldName].length > 0) {
                                    return (
                                        <p key={i}>{this.state.error[fieldName]}</p>
                                    )
                                } else {
                                    return '';
                                }
                            })}
                        </div>

                        {this.state.loading && (
                            <Spinner animation="border" />
                        )}
                        {!this.state.loading && (
                            <Container>
                                <Form.Group controlId="form.name">
                                    <Form.Label>Nome</Form.Label>
                                    <Form.Control
                                        type="text"
                                        name="name"
                                        value={this.state.data.name}
                                        required
                                        onChange={this.handleChange}
                                    />
                                </Form.Group>
                                <Form.Group controlId="form.email">
                                    <Form.Label>E-Mail</Form.Label>
                                    <Form.Control
                                        type="text"
                                        name="email"
                                        value={this.state.data.email}
                                        onChange={this.handleChange}
                                    />
                                </Form.Group>
                                <Form.Group controlId="form.cpf">
                                    <Form.Label>CPF</Form.Label>
                                    <Form.Control
                                        type="text"
                                        name="cpf"
                                        value={this.state.data.cpf}
                                        onChange={this.handleChange}
                                    />
                                </Form.Group>
                                <Form.Group controlId="form.phone">
                                    <Form.Label>Telefone</Form.Label>
                                    <Form.Control
                                        type="text"
                                        name="phone"
                                        value={this.state.data.phone}
                                        onChange={this.handleChange}
                                    />
                                </Form.Group>
                                <Form.Group controlId="form.adress">
                                    <Form.Label>Endereço</Form.Label>
                                    <Form.Control
                                        type="text"
                                        name="address"
                                        value={this.state.data.address}
                                        onChange={this.handleChange}
                                    />
                                </Form.Group>
                            </Container>
                        )}
                    </Modal.Body>
                    <Modal.Footer>
                        <Button
                            variant="secondary"
                            onClick={this.handleClose}
                            disabled={this.state.loading}
                        >
                            Fechar
                        </Button>
                        {!this.props.updateId && <Button
                            variant="primary"
                            onClick={() => this.handleSubmit()}
                            disabled={this.state.loading}
                        >Cadastrar</Button>}
                        {this.props.updateId && <Button
                            variant="primary"
                            onClick={() => this.handleSubmit()}
                            disabled={this.state.loading}
                        >Alterar</Button>}
                    </Modal.Footer>
                </Modal>
            </Form>
        );
    }
}