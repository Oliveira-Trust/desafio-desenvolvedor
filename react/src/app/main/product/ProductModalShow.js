import React from "react";
import { Button, Form, Modal, Spinner, Table } from "react-bootstrap";
import { destroy, show } from "./Product.service";

const formStateInit = {
    id: null,
    name: "",
    description: "",
    category_id: 0,
    color: "#000000",
    size: 0.0,
}

export default class ProductModalShow extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            categories: null,
            loading: false,
            error: null,
            data: {
                ...formStateInit,
            }
        }

        this.handleClose = this.handleClose.bind(this);
        this.onShow = this.onShow.bind(this);
    }

    onShow = async () => {
        this.setState({ loading: true });

        await show(this.props.id).then(res => {
            this.setState({ data: res })
        });

        this.setState({ loading: false });
    }

    handleClose() {
        this.setState({ data: formStateInit })
        this.props.handleClose();
    }

    handleSubmit = async () => {
        this.setState({ loading: true });
        // eslint-disable-next-line no-restricted-globals
        if (confirm("Esta ação é irreversível, tem certeza?")) {
            await destroy(this.props.id);

            this.setState({ loading: false });
            this.props.handleClose();
        }
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
                        <Modal.Title>Detalhes do Produto</Modal.Title>
                    </Modal.Header>
                    <Modal.Body>
                        {this.state.loading && (
                            <Spinner animation="border" />
                        )}
                        {this.state.data && (
                            <Table>
                                <tbody>
                                    <tr>
                                        <th>Nome</th>
                                        <td>{this.state.data.name}</td>
                                    </tr>
                                    <tr>
                                        <th>Descrição</th>
                                        <td>{this.state.data.description}</td>
                                    </tr>
                                    <tr>
                                        <th>Tamanho</th>
                                        <td>{this.state.data.size?.toLocaleString('pt-BR', { minimumFractionDigits: 3 })}</td>
                                    </tr>
                                    <tr>
                                        <th>Preço</th>
                                        <td>R$ {this.state.data.price?.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}</td>
                                    </tr>
                                    <tr>
                                        <th>Cor</th>
                                        <td style={{backgroundColor: this.state.data.color}}></td>
                                    </tr>
                                </tbody>
                            </Table>
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
                        <Button
                            variant="danger"
                            onClick={() => this.handleSubmit()}
                            disabled={this.state.loading}
                        >Excluir</Button>
                    </Modal.Footer>
                </Modal>
            </Form>
        );
    }
}