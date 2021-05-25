<script>
  import { token } from '../stores.js';
  
  import {
    Collapse,
    Navbar,
    NavbarToggler,
    NavbarBrand,
    Nav,
    NavItem,
    NavLink,
    Col,
    Container,
    Row,
    Card,
    CardBody
  } from 'sveltestrap';

  import {
    UsersIcon,
    PackageIcon,
    ShoppingCartIcon,
    LogOutIcon
  } from 'svelte-feather-icons';

  let isOpen = false;
  function handleUpdate(event) {
    isOpen = event.detail.isOpen;
  }

  function logout() {
    token.set(null);
    localStorage.removeItem('token');
  }
</script>

<Navbar color="dark" dark expand="md">
  <NavbarBrand href="/">Oliveira Trust</NavbarBrand>
  <NavbarToggler on:click={() => (isOpen = !isOpen)} />
  <Collapse {isOpen} navbar expand="md" on:update={handleUpdate}>
    <Nav class="ms-auto" navbar>
      <NavItem>
        <NavLink href="/clientes"><UsersIcon size="18"/> Clientes</NavLink>
      </NavItem>
      <NavItem>
        <NavLink href="/produtos"><PackageIcon size="18"/> Produtos</NavLink>
      </NavItem>
      <NavItem>
        <NavLink href="/pedidos"><ShoppingCartIcon size="18"/> Pedidos</NavLink>
      </NavItem>
      <NavItem>
        <NavLink on:click={logout}><LogOutIcon size="18"/> Sair</NavLink>
      </NavItem>
    </Nav>
  </Collapse>
</Navbar>

<Container>
  <Row>
    <Col>
      <Card>
        <CardBody>
          <slot/>
        </CardBody>
      </Card>
    </Col>
  </Row>
</Container>