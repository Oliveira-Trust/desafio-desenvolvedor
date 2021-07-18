import React from "react";
import { Button, Col, Container, Dropdown, DropdownButton, Form, Row, Spinner } from "react-bootstrap";
import Table from 'react-bootstrap/Table';
import { destroyAll, readAll } from "./Product.service";
import ProductModalForm from "./ProductModalForm";
import ProductModalShow from "./ProductModalShow";

class Products extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            data: null,
            dataFull: null,
            showFormModal: false,
            updateId: null,
            filter: null
        };

        this.getReadAll = this.getReadAll.bind(this);
        this.clickShowFormModal = this.clickShowFormModal.bind(this);
        this.handleCloseFormModal = this.handleCloseFormModal.bind(this);
        this.clickShowFormModal = this.clickShowFormModal.bind(this);
        this.handleCloseFormModal = this.handleCloseFormModal.bind(this);
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

        var dataFiltered = [].concat(this.state.dataFull)
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
                <ProductModalForm
                    show={this.state.showFormModal}
                    handleClose={this.handleCloseFormModal}
                    updateId={this.state.updateId}
                />
                <ProductModalShow
                    show={this.state.showModalShow}
                    handleClose={this.handleCloseShowModal}
                    id={this.state.updateId}
                />
                <Container fluid>
                    <Row>
                        <Col><h3>Lista de Produtos</h3></Col>
                        <Col></Col>
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
                <Table striped bordered hover>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th onClick={() => this.handleClickOrder('name')}>Nome</th>
                            <th>Categoria</th>
                            <th onClick={() => this.handleClickOrder('size')}>Tamanho</th>
                            <th onClick={() => this.handleClickOrder('price')}>Preço</th>
                            <th style={{ width: '50px' }}>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {!this.state.data && (
                            <tr>
                                <td colSpan="6" style={{ textAlign: "center" }}>
                                    <Spinner animation="border" />
                                </td>
                            </tr>
                        )}
                        {this.state.data && this.state.data.map((product, i) => (
                            <tr key={i}>
                                <td>
                                    <Form.Check.Input
                                        type="checkbox"
                                        name={product.id}
                                        value={product.isChecked}
                                        onChange={() => this.handleCheck(i)}
                                    />
                                </td>
                                <td>{product.name}</td>
                                <td>{product.category?.name}</td>
                                <td>{product.size?.toLocaleString('pt-BR', { minimumFractionDigits: 3 })}</td>
                                <td>R$ {product.price?.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}</td>
                                <td>
                                    <DropdownButton id="dropdown-basic-button" title="Ações" size="sm">
                                        <Dropdown.Item
                                            href="#/action-1"
                                            onClick={() => this.clickShowModalShow(product.id)}
                                        >Detalhes</Dropdown.Item>
                                        <Dropdown.Item
                                            href="#/action-2"
                                            onClick={() => this.clickShowFormModal(product.id)}
                                        >Editar</Dropdown.Item>
                                        <Dropdown.Item
                                            href="#/action-1"
                                            onClick={() => this.clickShowModalShow(product.id)}
                                        >Excuir</Dropdown.Item>

                                    </DropdownButton>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </Table>
            </>
        )
    }
}

export default Products;