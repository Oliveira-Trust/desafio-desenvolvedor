import React from "react";
import { Button, Container, Form, Modal, Spinner, Table } from "react-bootstrap";
import { create, show, update } from "./Order.service";
import { readAll as readAllProduct } from "../product/Product.service";
import { readAll as readAllCustomer } from "../customer/Customer.service";

const formStateInit = {
    id: null,
    customer_id: 0,
    products: []
}

const formProductNewStateInit = {
    disabled: true,
    product_id: 0,
    quantity: 0,
    price: 0,
}

export default class OrderModalForm extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            customers: null,
            products: null,
            product_new: formProductNewStateInit,
            update: false,
            loading: false,
            validated: false,
            error: null,
            data: formStateInit
        }

        this.handleChange = this.handleChange.bind(this);
        this.handleClose = this.handleClose.bind(this);
        this.setDataState = this.setDataState.bind(this);
        this.onShow = this.onShow.bind(this);
        this.handleChangeNewProduct = this.handleChangeNewProduct.bind(this);
        this.handleClickNewProduct = this.handleClickNewProduct.bind(this);
        this.handleClickRemoveProduct = this.handleClickRemoveProduct.bind(this);
    }

    componentDidMount() {
        readAllProduct().then(data => {
            this.setState({ products: data });
        })
        readAllCustomer().then(data => {
            this.setState({ customers: data });
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
    handleChangeNewProduct(event) {
        if (event.target.name === "product_id") {
            const newProduct = {
                product_id: parseInt(event.target.value),
                quantity: 1,
                price: this.state.products.find((p) => p.id === parseInt(event.target.value)).price
            }

            this.setState({ product_new: newProduct });
        } else {
            var newData = {
                ...this.state.product_new,
                [event.target.name]: event.target.value
            }
            this.setState({
                product_new: newData
            })
        }

    }
    disabledNewProductButton() {
        var newP = this.state.product_new;
        var newData = {
            ...this.state.product_new,
        }
        if (!newP.product_id || newP.quantity <= 0 || newP.price <= 0) {
            newData['disabled'] = true;
            this.setState({
                product_new: newData
            })
            return;
        }
        newData['disabled'] = false;
        this.setState({
            product_new: newData
        })
    }

    handleClickNewProduct() {
        var newData = this.state.data;
        newData.products.push(this.state.product_new);

        this.setState({
            data: newData,
            product_new: formProductNewStateInit
        })
    }
    handleClickRemoveProduct(index) {
        var newData = this.state.data;
        newData.products.splice(index, 1);

        this.setState({
            data: newData,
            product_new: formProductNewStateInit
        })
    }

    handleChange(event) {
        const target = event.target;
        const value = target.type === 'checkbox' ? target.checked : target.value;
        const name = target.name;

        this.setDataState(name, value);
    }

    handleSubmit = async () => {
        this.setState({ loading: true });
        this.setState({ error: null });
        if (this.props.updateId) {
            await update(this.props.updateId, this.state.data).then(res => {
                this.handleClose()
            })
                .catch(error => {
                    this.setState({ error: error.response.data });
                })
        } else {
            await create(this.state.data).then(res => {
                this.handleClose()
            })
                .catch(error => {
                    this.setState({ error: error.response.data });
                })

        }
        this.setState({ loading: false });
    }

    onShow = async () => {
        if (this.props.updateId) {
            this.setState({ loading: true });

            await show(this.props.updateId).then(res => {
                var products = [];
                res.products.forEach((p)=>{
                    products.push(p.pivot)
                })
                res.products = products;
                this.setState({ data: res })
            });

            this.setState({ loading: false });
        } else {
            console.log(this.state.data)
            this.setState({
                data: formStateInit,
                product_new: formProductNewStateInit
            })
        }
    }

    handleClose() {
        this.setState({
            data: formStateInit,
            product_new: formProductNewStateInit
        })
        this.props.handleClose();
    }

    render() {
        return (
            <Form id="formPedido" >
                <Modal
                    show={this.props.show}
                    onShow={this.onShow}
                    onHide={this.handleClose}
                    backdrop="static"
                    keyboard={false}
                    fullscreen='sm-down'
                >
                    <Modal.Header closeButton>
                        {!this.props.updateId && <Modal.Title>Cadastro de Pedido</Modal.Title>}
                        {this.props.updateId && <Modal.Title>Alteração de Pedido</Modal.Title>}
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

                                <Form.Group controlId="form.Customer">
                                    <Form.Label>Cliente</Form.Label>
                                    <select
                                        required
                                        name="customer_id"
                                        onChange={this.handleChange}
                                        value={this.state.data.customer_id}
                                    >
                                        <option>-- Selecione --</option>
                                        {this.state.customers && this.state.customers.map((c, i) => (
                                            <option key={i} value={c.id}>{c.name}</option>
                                        ))}
                                    </select>
                                </Form.Group>
                                <Form.Group controlId="form.status">
                                    <Form.Label>Status</Form.Label>
                                    <select
                                        required
                                        name="status"
                                        onChange={this.handleChange}
                                        value={this.state.data.status}
                                    >
                                        <option>-- Selecione --</option>
                                        <option value="opened">Em Aberto</option>
                                        <option value="paid">Pago</option>
                                        <option value="canceled">Cancelado</option>
                                    </select>
                                </Form.Group>

                                <hr />

                                <Table striped bordered hover>
                                    <thead>
                                        <tr>
                                            <th>
                                                <select
                                                    name="product_id"
                                                    onChange={this.handleChangeNewProduct}
                                                    value={this.state.product_new.product_id}
                                                >
                                                    <option value={0}>-- Selecione --</option>
                                                    {this.state.products && this.state.products.map((c, i) => (
                                                        <option key={i} value={c.id}>{c.name}</option>
                                                    ))}
                                                </select>
                                            </th>
                                            <th>
                                                <Form.Control
                                                    type="text"
                                                    name="quantity"
                                                    value={this.state.product_new.quantity}
                                                    required
                                                    onChange={this.handleChangeNewProduct}
                                                />
                                            </th>
                                            <th>
                                                <Form.Control
                                                    type="text"
                                                    name="price"
                                                    value={this.state.product_new.price}
                                                    required
                                                    onChange={this.handleChangeNewProduct}
                                                />
                                            </th>
                                            <th>
                                                <Button
                                                    variant="success"
                                                    onClick={this.handleClickNewProduct}
                                                    disabled={this.state.product_new.disabled}
                                                >+</Button>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Produto</th>
                                            <th>Qtd.</th>
                                            <th>Preço</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {this.state.data.products.map((product, k) => (
                                            <tr key={k}>
                                                <td>
                                                    {this.state.products.find((p) => p.id === product.product_id)?.name}
                                                </td>
                                                <td>{product.quantity}</td>
                                                <td>{product.price}</td>
                                                <td>
                                                    <Button
                                                        variant="danger"
                                                        onClick={() => this.handleClickRemoveProduct(k)}
                                                    >X</Button>
                                                </td>
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