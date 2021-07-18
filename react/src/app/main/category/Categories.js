import React from "react";
import { Button, Col, Container, Dropdown, DropdownButton, Form, Row, Spinner } from "react-bootstrap";
import Table from 'react-bootstrap/Table';
import { destroyAll, readAll } from "./Category.service";
import CategoryModalForm from "./CategoryModalForm";
import CategoryModalShow from "./CategoryModalShow";

class Categories extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            dataFull: null,
            data: null,
            showFormModal: false,
            updateId: null,
            disabledBulkOperations: true,
            filter: null
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
                <CategoryModalForm
                    show={this.state.showFormModal}
                    handleClose={this.handleCloseFormModal}
                    updateId={this.state.updateId}
                />
                <CategoryModalShow
                    show={this.state.showModalShow}
                    handleClose={this.handleCloseShowModal}
                    id={this.state.updateId}
                />
                <Container fluid>
                    <Row>
                        <Col><h3>Lista de Categorias</h3></Col>
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
                            <th style={{ width: '15px' }}>
                                #
                            </th>
                            <th>
                                Nome
                            </th>
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
                        {this.state.data && this.state.data.map((category, i) => (
                            <tr key={i}>
                                <td>
                                    <Form.Check.Input
                                        type="checkbox"
                                        name={category.id}
                                        value={category.isChecked}
                                        onChange={() => this.handleCheck(i)}
                                    />
                                </td>
                                <td>{category.name}</td>
                                <td>
                                    <DropdownButton id="dropdown-basic-button" title="Ações" size="sm">
                                        <Dropdown.Item
                                            href="#/action-1"
                                            onClick={() => this.clickShowModalShow(category.id)}
                                        >Detalhes</Dropdown.Item>
                                        <Dropdown.Item
                                            href="#/action-2"
                                            onClick={() => this.clickShowFormModal(category.id)}
                                        >Editar</Dropdown.Item>
                                        <Dropdown.Item
                                            href="#/action-1"
                                            onClick={() => this.clickShowModalShow(category.id)}
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

export default Categories;