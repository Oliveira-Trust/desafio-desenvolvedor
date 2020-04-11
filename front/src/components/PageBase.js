import React from "react";
import PropTypes from "prop-types";
import Paper from "@material-ui/core/Paper";
import Divider from "@material-ui/core/Divider";
import Zoom from '@material-ui/core/Zoom';
import globalStyles from "../styles";

const PageBase = props => {
  const { title, navigation } = props;

  return (
    <Zoom  in={true}
    {...(true ? { timeout: (300)  } : {})}>
      <div>
        <Paper style={globalStyles.paper}>
          <h3 style={globalStyles.title}>{title}</h3>

          <Divider />
          {props.children}

          <div style={globalStyles.clear} />
        </Paper>
      </div>
    </Zoom>
  );
};

PageBase.propTypes = {
  title: PropTypes.string,
  navigation: PropTypes.string,
  children: PropTypes.element
};

export default PageBase;
