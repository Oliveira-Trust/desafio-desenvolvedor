import React from "react";
import { Button, Container, Form, Modal, Spinner, Table } from "react-bootstrap";
import { destroy, show } from "./Order.service";

export default class OrderModalShow extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            loading: false,
            error: null,
            data: null
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
        this.setState({ data: null })
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
                        <Modal.Title>Detalhes do Pedido</Modal.Title>
                    </Modal.Header>
                    <Modal.Body>
                        {this.state.loading && (
                            <Spinner animation="border" />
                        )}
                        {this.state.data && (
                            <Container>
                                <Table>
                                    <tbody>
                                        <tr>
                                            <th>Usuário</th>
                                            <td>{this.state.data.user?.name}</td>
                                        </tr>
                                        <tr>
                                            <th>Cliente</th>
                                            <td>{this.state.data.customer?.name}</td>
                                        </tr>
                                    </tbody>
                                </Table>
                                <Table>
                                    <thead>
                                        <tr>
                                            <th>Produto</th>
                                            <th>Qtd.</th>
                                            <th>Preço</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {this.state.data.products.map((product, i) => (
                                            <tr key={i}>
                                                <td>{product.name}</td>
                                                <td>{product.pivot.quantity}</td>
                                                <td>R$ {parseFloat(product.pivot.quantity * product.pivot.price).toLocaleString('pt-BR', { minimumFractionDigits: 2 })}</td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </Table>
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