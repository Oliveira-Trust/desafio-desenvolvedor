import * as React from 'react';
import AppBar from '@mui/material/AppBar';
import Box from '@mui/material/Box';
import Toolbar from '@mui/material/Toolbar';
import IconButton from '@mui/material/IconButton';
import Typography from '@mui/material/Typography';
import Menu from '@mui/material/Menu';
import MenuIcon from '@mui/icons-material/Menu';
import Container from '@mui/material/Container';
import Avatar from '@mui/material/Avatar';
import Tooltip from '@mui/material/Tooltip';
import MenuItem from '@mui/material/MenuItem';
import CurrencyExchangeIcon from '@mui/icons-material/CurrencyExchange';

import { useContext } from 'react';
import { useNavigate } from 'react-router-dom';

import { AuthContext } from '../context/AuthContext';

import styles from './styles/NavBar.module.css';

const NavBar = () => {
  const { user, isAuthenticated, isAdmin } = useContext(AuthContext);
  const navigate = useNavigate();

  const [anchorElNav, setAnchorElNav] = React.useState(null);
  const [anchorElUser, setAnchorElUser] = React.useState(null);

  const handleOpenNavMenu = (event) => {
    setAnchorElNav(event.currentTarget);
  };

  const handleCloseNavMenu = () => {
    setAnchorElNav(null);
  };

  const handleCloseUserMenu = () => {
    setAnchorElUser(null);
  };

  const goTo = (data) => {
    navigate(data);
  }

  const handleLogout = () => {
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    navigate('/login');
  }

  return (
    <AppBar position="static" color="success">
      <Container maxWidth="xl">
        <Toolbar disableGutters>
          <CurrencyExchangeIcon sx={{ display: { xs: 'none', md: 'flex' }, mr: 1 }} fontSize="large"/>
          &nbsp;
          <Typography
            variant="h6"
            noWrap
            component="a"
            href="/"
            sx={{
              mr: 2,
              display: { xs: 'none', md: 'flex' },
              fontFamily: 'monospace',
              fontWeight: 700,
              letterSpacing: '.1rem',
              color: 'inherit',
              textDecoration: 'none',
            }}
          >
            Exchangify
          </Typography>

          <Box sx={{ flexGrow: 1, display: { xs: 'flex', md: 'none' } }}>
            <IconButton
              size="large"
              aria-label="account of current user"
              aria-controls="menu-appbar"
              aria-haspopup="true"
              onClick={handleOpenNavMenu}
              color="inherit"
            >
              <MenuIcon />
            </IconButton>
            <Menu
              id="menu-appbar"
              anchorEl={anchorElNav}
              anchorOrigin={{
                vertical: 'bottom',
                horizontal: 'left',
              }}
              keepMounted
              transformOrigin={{
                vertical: 'top',
                horizontal: 'left',
              }}
              open={Boolean(anchorElNav)}
              onClose={handleCloseNavMenu}
              sx={{
                display: { xs: 'block', md: 'none' },
              }}
            >
              <MenuItem onClick={() => goTo('/exchange')}>
                <Typography textAlign="center">Câmbio</Typography>
              </MenuItem>
              {isAdmin() && 
              <MenuItem onClick={() => goTo('/config')}>
                <Typography textAlign="center">Config</Typography>
              </MenuItem>}
            </Menu>
          </Box>
          <CurrencyExchangeIcon sx={{ display: { xs: 'flex', md: 'none' }, mr: 1 }} />
          <Typography
            variant="h5"
            noWrap
            component="a"
            href="/"
            sx={{
              mr: 2,
              display: { xs: 'flex', md: 'none' },
              flexGrow: 1,
              fontFamily: 'monospace',
              fontWeight: 700,
              letterSpacing: '.3rem',
              color: 'inherit',
              textDecoration: 'none',
            }}
          >
            Exchangify
          </Typography>
          <Box sx={{ flexGrow: 1, display: { xs: 'none', md: 'flex' } }}>
            <a className={styles.login_label} href="/exchange">Câmbio</a>
            &nbsp;&nbsp;
            {isAdmin() && <a className={styles.login_label} href="/config">Config</a>}
          </Box>

          {isAuthenticated() ?
          <Box sx={{ flexGrow: 0 }} className={styles.profile_row}>
            <Tooltip title="Open settings">
              <IconButton onClick={() => goTo('/profile')} sx={{ p: 0 }}>
                <Avatar alt={user?.current?.name} src={user?.current?.profile_picture} />
              </IconButton>
            </Tooltip>
            <Menu
              sx={{ mt: '45px' }}
              id="menu-appbar"
              anchorEl={anchorElUser}
              anchorOrigin={{
                vertical: 'top',
                horizontal: 'right',
              }}
              keepMounted
              transformOrigin={{
                vertical: 'top',
                horizontal: 'right',
              }}
              open={Boolean(anchorElUser)}
              onClose={handleCloseUserMenu}
            >
              <MenuItem onClick={() => goTo('/exchange')}>
                <Typography textAlign="center">Câmbio</Typography>
              </MenuItem>
              {isAdmin() && <MenuItem onClick={() => goTo('/config')}>
                <Typography textAlign="center">Config</Typography>
              </MenuItem>}
            </Menu>
            &nbsp;
            <a
              sx={{ cursor: "pointer" }}
              onClick={handleLogout}
            >
              Sair
            </a>
          </Box> : <a className={styles.login_label} href="/login">Login</a>}
        </Toolbar>
      </Container>
    </AppBar>
  );
}
export default NavBar;
