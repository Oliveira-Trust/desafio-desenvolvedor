import React, { useState } from "react";
import classNames from "classnames";
import AppBar from "@material-ui/core/AppBar";
import IconButton from "@material-ui/core/IconButton";
import MenuIcon from "@material-ui/icons/Menu";
import Menu from "@material-ui/core/Menu";
import NotificationsIcon from "@material-ui/icons/Notifications";
import Badge from "@material-ui/core/Badge";
import { Toolbar } from "@material-ui/core";
import MenuItem from "@material-ui/core/MenuItem";
import { makeStyles } from '@material-ui/core/styles';

const useStyles = makeStyles(theme => ({
  appBar: {
    zIndex: theme.zIndex.drawer + 1,
    transition: theme.transitions.create(["width", "margin"], {
      easing: theme.transitions.easing.sharp,
      duration: theme.transitions.duration.leavingScreen
    })
  },
  appBarShift: {
    // marginLeft: theme.drawer.width,
    width: `calc(100% - ${theme.drawer.width}px)`,
    transition: theme.transitions.create(["width", "margin"], {
      easing: theme.transitions.easing.sharp,
      duration: theme.transitions.duration.enteringScreen
    })
  },
  root: {
    width: "100%"
  },
  grow: {
    flexGrow: 1
  },
  menuButton: {
    marginLeft: -12,
    marginRight: 10
  },
  title: {
    display: "none",
    [theme.breakpoints.up("sm")]: {
      display: "block"
    }
  },
  sectionDesktop: {
    display: "none",
    [theme.breakpoints.up("md")]: {
      display: "flex"
    }
  },
  sectionMobile: {
    display: "flex",
    [theme.breakpoints.up("md")]: {
      display: "none"
    }
  }
}));

function Header(props) {
  const classes = useStyles();

  const [notificationMenuAnchorEl, setNotificationMenuAnchorEl] = useState(null)
  // Notifications
  const handleNotificationMenuOpen = event => {
    setNotificationMenuAnchorEl(event.currentTarget);
  };

  const handleNotificationMenuClose = () => {
    setNotificationMenuAnchorEl(null);
  };

  return (
    <div>
      <AppBar
        className={classNames(classes.appBar, {
          [classes.appBarShift]: props.navDrawerOpen
        })}
      >
        <Toolbar>
          <IconButton
            className={classes.menuButton}
            color="inherit"
            aria-label="Open drawer"
            onClick={props.handleChangeNavDrawer}
          >
            <MenuIcon />
          </IconButton>

          <div className={classes.grow} />
          <div className={classes.sectionDesktop}>

            {/* NOTIFICATIONS */}
            <IconButton color="inherit" onClick={handleNotificationMenuOpen}>
              <Badge
                className={classes.margin}
                badgeContent={0}
                color="secondary"
              >
                <NotificationsIcon />
              </Badge>
            </IconButton>
          </div>
          <div className={classes.sectionMobile}>

            {/* NOTIFICATIONS MOBILE */}
            <IconButton color="inherit" onClick={handleNotificationMenuOpen}>
              <Badge
                className={classes.margin}
                badgeContent={0}
                color="secondary"
              >
                <NotificationsIcon />
              </Badge>
            </IconButton>

            {/* NOTIFICATIONS MENU */}
            <Menu
              anchorEl={notificationMenuAnchorEl}
              anchorOrigin={{ vertical: "top", horizontal: "right" }}
              transformOrigin={{ vertical: "top", horizontal: "right" }}
              open={Boolean(notificationMenuAnchorEl)}
              onClose={handleNotificationMenuClose}
            >
              <MenuItem>
                {/* <ListItemIcon>
                  <NotificationsIcon />
                </ListItemIcon>
                <ListItemText primary="Nenhuma notificação" /> */}
                Nenhuma notificação
              </MenuItem>
            </Menu>
          </div>
        </Toolbar>
      </AppBar>
    </div>
  );
  // }
}


export default Header;
