import React from "react";
import { Link } from "react-router-dom";
import PropTypes from "prop-types";
import { withStyles } from "@material-ui/core/styles";
import Table from "@material-ui/core/Table";
import TableBody from "@material-ui/core/TableBody";
import TableCell from "@material-ui/core/TableCell";
import TablePagination from "@material-ui/core/TablePagination";
import TableRow from "@material-ui/core/TableRow";
import Paper from "@material-ui/core/Paper";
import Checkbox from "@material-ui/core/Checkbox";
import IconButton from "@material-ui/core/IconButton";
import ContentCreate from "@material-ui/icons/Create";

import EnhancedTableHead from "./DataTables/EnhancedTableHead";
import EnhancedTableToolbar from "./DataTables/EnhancedTableToolbar";
// import tableData from "../../../data";
import api from "../../../services/api";

import { compose } from "redux";
import { bindActionCreators } from "redux";
import { connect } from "react-redux";

import * as snackbarActions from "../../../_actions/snackbar";
import * as userActions from "../../../_actions/user";

const desc = (a, b, orderBy) => {
  if (b[orderBy] < a[orderBy]) {
    return -1;
  }
  if (b[orderBy] > a[orderBy]) {
    return 1;
  }
  return 0;
};

const stableSort = (array, cmp) => {
  const stabilizedThis = array.map((el, index) => [el, index]);
  stabilizedThis.sort((a, b) => {
    const order = cmp(a[0], b[0]);
    if (order !== 0) return order;
    return a[1] - b[1];
  });
  return stabilizedThis.map(el => el[0]);
};

const getSorting = (order, orderBy) => {
  return order === "desc"
    ? (a, b) => desc(a, b, orderBy)
    : (a, b) => -desc(a, b, orderBy);
};

const styles = theme => ({
  root: {
    width: "100%",
    marginTop: theme.spacing(3)
  },
  table: {
    minWidth: 650
  },
  tableWrapper: {
    overflowX: "auto"
  }
});

class ClientList extends React.Component {
  constructor(props) {
    super(props);
    this.getUserData();
  }

  state = {
    order: "asc",
    orderBy: "id",
    selected: [],
    data: [],
    page: 0,
    rowsPerPage: 10
  };

  // TABLE CONFIGURATIONS
  handleRequestSort = (event, property) => {
    const orderBy = property;
    let order = "desc";

    if (this.state.orderBy === property && this.state.order === "desc") {
      order = "asc";
    }

    this.setState({ order, orderBy });
  };

  handleSelectAllClick = event => {
    if (event.target.checked) {
      this.setState(state => ({ selected: state.data.map(n => n.id) }));
      return;
    }
    this.setState({ selected: [] });
  };

  handleClick = (event, id) => {
    const { selected } = this.state;
    const selectedIndex = selected.indexOf(id);
    let newSelected = [];

    if (selectedIndex === -1) {
      newSelected = newSelected.concat(selected, id);
    } else if (selectedIndex === 0) {
      newSelected = newSelected.concat(selected.slice(1));
    } else if (selectedIndex === selected.length - 1) {
      newSelected = newSelected.concat(selected.slice(0, -1));
    } else if (selectedIndex > 0) {
      newSelected = newSelected.concat(
        selected.slice(0, selectedIndex),
        selected.slice(selectedIndex + 1)
      );
    }

    this.setState({ selected: newSelected });
  };

  handleChangePage = (event, page) => {
    this.setState({ page });
  };

  handleChangeRowsPerPage = event => {
    this.setState({ rowsPerPage: event.target.value });
  };

  isSelected = id => this.state.selected.indexOf(id) !== -1;

  // USER RELATED METHODS

  getUserData = () => {
    api.get("/client")
      .then((res) => {
        this.setState({ data: res.data.data });
      })
  }

  deleteUser = () => {
    this.state.selected.map(async (clientId) => {
      await api.delete(`/client/${clientId}`)
        .then((res) => {
          this.props.snackbarActions.showSnackbar(this.state.selected.length > 1 ?"Clientes excluídos com sucesso" : "Cliente excluído com sucesso");
          this.getUserData();
          // console.log(res);
        })
        .catch((err) => {
          this.props.snackbarActions.showSnackbar("Houve um problema ao realizar esta ação");
          this.getUserData();
          console.log(err);
        });
    });
    this.setState({selected: []});
  }

  render() {
    const { classes } = this.props;
    const { data, order, orderBy, selected, rowsPerPage, page } = this.state;
    const emptyRows =
      rowsPerPage - Math.min(rowsPerPage, data.length - page * rowsPerPage);

    return (
      <Paper className={classes.root}>
        <EnhancedTableToolbar 
          numSelected={selected.length}
          onDeleteConfirmation={this.deleteUser}
        />
        <div className={classes.tableWrapper}>
          <Table className={classes.table} size="small" aria-labelledby="tableTitle">
            <EnhancedTableHead
              numSelected={selected.length}
              order={order}
              orderBy={orderBy}
              onSelectAllClick={this.handleSelectAllClick}
              onRequestSort={this.handleRequestSort}
              rowCount={data.length}
            />
            <TableBody>
              {stableSort(data, getSorting(order, orderBy))
                .slice(page * rowsPerPage, page * rowsPerPage + rowsPerPage)
                .map(n => {
                  const isSelected = this.isSelected(n.id);
                  return (
                    <TableRow
                      hover
                      onClick={this.props.user.id !== n.id ? event => this.handleClick(event, n.id) : null}
                      role="checkbox"
                      aria-checked={isSelected}
                      tabIndex={-1}
                      key={n.id}
                      selected={isSelected}
                    >
                      <TableCell padding="checkbox">
                        <Checkbox checked={isSelected} disabled={this.props.user.id === n.id} />
                      </TableCell>
                      <TableCell>{n.name}</TableCell>
                      <TableCell>{n.email}</TableCell>
                      <TableCell>
                        <Link className="button" to={`/perfil/${n.id}`}>
                          <IconButton>
                            <ContentCreate />
                          </IconButton>
                        </Link>
                      </TableCell>
                    </TableRow>
                  );
                })}
              {emptyRows > 0 && (
                <TableRow style={{ height: 1 * emptyRows }}>
                  <TableCell colSpan={6} />
                </TableRow>
              )}
            </TableBody>
          </Table>
        </div>
        <TablePagination
          rowsPerPageOptions={[5, 10, 25]}
          component="div"
          count={data.length}
          rowsPerPage={rowsPerPage}
          page={page}
          backIconButtonProps={{
            "aria-label": "Previous Page"
          }}
          nextIconButtonProps={{
            "aria-label": "Next Page"
          }}
          onChangePage={this.handleChangePage}
          onChangeRowsPerPage={this.handleChangeRowsPerPage}
        />
      </Paper>
    );
  }
}

ClientList.propTypes = {
  classes: PropTypes.object.isRequired
};


const mapStateToProps = state => ({
  user: state.user,
});


function mapDispatchToProps (dispatch) {
  return {
    userActions: bindActionCreators(userActions, dispatch),
    snackbarActions: bindActionCreators(snackbarActions, dispatch),
  };
}

export default compose( withStyles(styles), connect(mapStateToProps, mapDispatchToProps) )(ClientList);
