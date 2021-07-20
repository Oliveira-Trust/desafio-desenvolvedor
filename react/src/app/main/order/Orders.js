import React from "react";
import { Button, Col, Container, Dropdown, DropdownButton, Form, Row, Spinner } from "react-bootstrap";
import Table from 'react-bootstrap/Table';
import { destroyAll, readAll } from "./Order.service";
import OrderModalForm from "./OrderModalForm";
import OrderModalShow from "./OrderModalShow";

class Orders extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            dataFull: null,
            data: null,
            showFormModal: false,
            updateId: null,
            disabledBulkOperations: true,
            filter: ""
        };

        this.getReadAll = this.getReadAll.bind(this);
        this.clickShowFormModal = this.clickShowFormModal.bind(this);
        this.handleCloseFormModal = this.handleCloseFormModal.bind(this);
        this.clickShowFormModal = this.clickShowFormModal.bind(this);
        this.handleCloseFormModal = this.handleCloseFormModal.bind(this);
        this.handleCheck = this.handleCheck.bind(this);
        this.clickBulkOperationsDelete = this.clickBulkOperationsDelete.bind(this);
    }

    getReadAll() {
        readAll().then(data => {
            this.setState({ data: data })
            this.setState({ dataFull: data })
        })
    }

    componentDidMount() {
        this.getReadAll()
    }

    handleCheck = (i) => {
        var newData = this.state.dataFull

        newData[i]['isChecked'] = !newData[i]['isChecked'];
        var filtered = newData.filter(function (d) { return d['isChecked'] })
        this.setState({
            disabledBulkOperations: (filtered.length <= 0)
        })

        this.setState({
            dataFull: newData
        })

    }
    clickBulkOperationsDelete = async () => {

        var filteredIds = this.state.data
            .filter(function (d) { return d['isChecked'] })
            .map(d => d['id']);

        this.setState({
            data: null
        })

        await destroyAll(filteredIds);
        await this.getReadAll()

        this.setState({
            disabledBulkOperations: true
        })
    }

    handleChangeFilter = (e) => {
        this.setState({ filter: e.target.value });

        if (e.target.value === "") {
            this.setState({ data: this.state.dataFull })
        }

        var dataFiltered = this.state.dataFull
            .filter(d => { return d.name.toLowerCase().includes(e.target.value.toLowerCase()) });

        this.setState({ data: dataFiltered })
    }

    handleClickOrder = (field) => {
        var dataSorted = this.state.data
            .sort((a, b) => a[field] > b[field] ? 1 : -1);

        this.setState({ data: dataSorted })
    }

    clickShowFormModal = (id = null) => {
        this.setState({ 'showFormModal': true });
        this.setState({ 'updateId': id });

    }
    handleCloseFormModal = () => {
        this.setState({ 'showFormModal': false });
        this.setState({ 'updateId': null });
        this.getReadAll()
    }

    clickShowModalShow = (id = null) => {
        this.setState({ 'showModalShow': true });
        this.setState({ 'updateId': id });

    }
    handleCloseShowModal = () => {
        this.setState({ 'showModalShow': false });
        this.setState({ 'updateId': null });
        this.getReadAll()
    }
    render() {
        return (
            <>
                <OrderModalForm
                    show={this.state.showFormModal}
                    handleClose={this.handleCloseFormModal}
                    updateId={this.state.updateId}
                />
                <OrderModalShow
                    show={this.state.showModalShow}
                    handleClose={this.handleCloseShowModal}
                    id={this.state.updateId}
                />
                <Container fluid>
                    <Row>
                        <Col><h3>Lista de Pedidos</h3></Col>
                        <Col md="auto">
                            <Button variant="primary" onClick={() => this.clickShowFormModal()}>Novo</Button>
                        </Col>
                    </Row>
                </Container>
                <br />
                <Container fluid>
                    <Row>
                        <Col>
                            <DropdownButton
                                id="dropdown-basic-button"
                                title="Ações em Massa"
                                size="sm"
                                disabled={this.state.disabledBulkOperations}
                            >
                                <Dropdown.Item
                                    href="#/action-1"
                                    onClick={() => this.clickBulkOperationsDelete()}
                                >Excuir</Dropdown.Item>
                            </DropdownButton>
                            {this.state.data && this.state.data
                                .filter(function (d) { return d['isChecked'] })
                                .map(d => d['id']).length} Selecionados
                        </Col>
                        <Col>
                            <Form.Control
                                size="sm"
                                type="text"
                                placeholder="Filtrar"
                                value={this.state.filter}
                                onChange={this.handleChangeFilter}

                            />
                        </Col>
                    </Row>
                </Container>
                <div style={{overflowY: 'visible'}}>
                    <Table striped bordered hover responsive="sm">
                        <thead>
                            <tr>
                                <th style={{ width: '20px' }}>
                                    #
                                </th>
                                <th>Usuário</th>
                                <th>Cliente</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th style={{ width: '50px' }}>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            {!this.state.data && (
                                <tr>
                                    <td colSpan="3" style={{ textAlign: "center" }}>
                                        <Spinner animation="border" />
                                    </td>
                                </tr>
                            )}
                            {this.state.data && this.state.data.map((order, i) => (
                                <tr key={i}>
                                    <td>
                                        <Form.Check.Input
                                            type="checkbox"
                                            name={order.id}
                                            value={order.isChecked}
                                            onChange={() => this.handleCheck(i)}
                                        />
                                        {order.id.toLocaleString('pt-BR', {minimumIntegerDigits: 3})}
                                    </td>
                                    <td style={{verticalAlign: 'middle'}}>{order.user?.name}</td>
                                    <td style={{verticalAlign: 'middle'}}>{order.customer?.name}</td>
                                    <td style={{verticalAlign: 'middle'}}>R$ {order.products.reduce((a, b) => {
                                        return a + parseFloat(b['pivot']['price'] * b['pivot']['quantity']);
                                    }, 0).toLocaleString('pt-BR', { minimumFractionDigits: 2 })}</td>
                                    <td style={{verticalAlign: 'middle'}}>{{"paid":"Pago", "opened": "Em Aberto", "canceled": "Cancelado"}[order.status]}</td>
                                    <td style={{verticalAlign: 'middle'}}>
                                        <DropdownButton id="dropdown-basic-button" title="Ações" size="sm">
                                            <Dropdown.Item
                                                href="#/action-1"
                                                onClick={() => this.clickShowModalShow(order.id)}
                                            >Detalhes</Dropdown.Item>
                                            <Dropdown.Item
                                                href="#/action-2"
                                                onClick={() => this.clickShowFormModal(order.id)}
                                            >Editar</Dropdown.Item>
                                            <Dropdown.Item
                                                href="#/action-1"
                                                onClick={() => this.clickShowModalShow(order.id)}
                                            >Excuir</Dropdown.Item>
                                        </DropdownButton>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </Table>
                </div>
            </>
        )
    }
}

export default Orders;