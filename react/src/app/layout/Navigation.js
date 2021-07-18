
import React from "react";
import { Container, Nav, Navbar, NavDropdown } from "react-bootstrap";
import { LinkContainer } from "react-router-bootstrap";

function Navigation({ removeToken }) {

  return (
    <Navbar collapseOnSelect expand="lg" bg="dark" variant="dark" fixed="top" >
      <Container>
        <LinkContainer to="/">
          <Navbar.Brand href="#home">Oliveira Trust</Navbar.Brand>
        </LinkContainer>
        <Navbar.Toggle aria-controls="responsive-navbar-nav" />

        <Navbar.Collapse id="responsive-navbar-nav">

          <Nav className="me-auto">

            <LinkContainer to="/customer">
              <Nav.Link>Clientes</Nav.Link>
            </LinkContainer>

            <NavDropdown title="Produtos" id="collasible-nav-dropdown">
              <LinkContainer to="/category">
                <NavDropdown.Item href="#action/3.1">Lista de Categorias</NavDropdown.Item>
              </LinkContainer>

              <NavDropdown.Divider />

              <LinkContainer to="/product">
                <NavDropdown.Item href="#action/3.1">Lista de Produtos</NavDropdown.Item>
              </LinkContainer>
            </NavDropdown>

          </Nav>
          <Nav className="me-auto">
            {/* <LinkContainer to="/logout"> */}
            <Nav.Link onClick={() => removeToken()}>Logout</Nav.Link>
            {/* </LinkContainer> */}
          </Nav>
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
}

export default Navigation;