import React from "react";
import { Button, Container, Form, Modal, Spinner } from "react-bootstrap";
import { readAll as readAllCategories } from "../category/Category.service";
import { create, show, update } from "./Product.service";

const formStateInit = {
    id: null,
    name: "",
    description: "",
    category_id: 0,
    color: "#000000",
    size: 0.0,
}

export default class ProductModalForm extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            categories: null,
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

    componentDidMount() {
        readAllCategories().then(data => {
            this.setState({categories: data});
        })
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
            })
            .catch(error => {
                this.setState({error: error.response.data});
            })
        } else {
            await create(this.state.data).then(res => {
                this.handleClose()
            })
            .catch(error => {
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
            <Form id="formProduto" >
                <Modal
                    show={this.props.show}
                    onShow={this.onShow}
                    onHide={this.handleClose}
                    backdrop="static"
                    keyboard={false}
                    fullscreen='sm-down'
                >
                    <Modal.Header closeButton>
                        {!this.props.updateId && <Modal.Title>Cadastro de Produto</Modal.Title>}
                        {this.props.updateId && <Modal.Title>Alteração de Produto</Modal.Title>}
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
                                <Form.Group controlId="form.Category">
                                    <Form.Label>Categoria</Form.Label>
                                    <select
                                        required
                                        name="category_id"
                                        onChange={this.handleChange}
                                        value={this.state.data.category_id}
                                    >
                                        <option>-- Selecione --</option>
                                        {this.state.categories && this.state.categories.map((c, i) => (
                                            <option key={i} value={c.id}>{c.name}</option>
                                        ))}
                                    </select>
                                </Form.Group>

                                <Form.Group controlId="form.name">
                                    <Form.Label>Nome</Form.Label>
                                    <Form.Control
                                        type="text"
                                        name="name"
                                        value={this.state.data.name}
                                        required
                                        onChange={this.handleChange}
                                    />
                                    <Form.Control.Feedback type="invalid">
                                        Please choose a username.
                                    </Form.Control.Feedback>
                                </Form.Group>
                                <Form.Group controlId="form.Size">
                                    <Form.Label>Tamanho</Form.Label>
                                    <Form.Control
                                        type="number"
                                        name="size"
                                        min="0.01"
                                        step="0.01"
                                        value={this.state.data.size}
                                        onChange={this.handleChange}
                                    />
                                </Form.Group>
                                <Form.Group controlId="form.Price">
                                    <Form.Label>Preço</Form.Label>
                                    <Form.Control
                                        type="number"
                                        name="price"
                                        min="0.01"
                                        step="0.01"
                                        value={this.state.data.price}
                                        onChange={this.handleChange}
                                    />
                                </Form.Group>
                                <Form.Group controlId="form.Description">
                                    <Form.Label>Descrição</Form.Label>
                                    <Form.Control
                                        as="textarea"
                                        rows={3}
                                        name="description"
                                        value={this.state.data.description}
                                        onChange={this.handleChange}
                                    />
                                </Form.Group>
                                <Form.Group controlId="form.Color">
                                    <Form.Label>Cor</Form.Label>
                                    <Form.Control
                                        type="color"
                                        name="color"
                                        value={this.state.data.color}
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