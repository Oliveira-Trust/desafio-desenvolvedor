import React, { useState } from "react";
import { Link } from "react-router-dom";
import Button from "@material-ui/core/Button";
import TextField from "@material-ui/core/TextField";
import FormControlLabel from "@material-ui/core/FormControlLabel";
import InputMask from 'react-input-mask'
import { MuiPickersUtilsProvider, KeyboardDatePicker } from '@material-ui/pickers';
import Switch from "@material-ui/core/Switch";
import Divider from "@material-ui/core/Divider";
import FormControl from "@material-ui/core/FormControl";
import PageBase from "../../../components/PageBase";
import styles from "./styles";
import DateFnsUtils from '@date-io/date-fns';

const FormPage = () => {
  const [selectedDate, setSelectedDate] = useState(new Date('2014-08-18T21:11:54'));

  const handleDateChange = (date) => {
    setSelectedDate(date);
  };
  return (
    <PageBase title="Novo Cliente">
      <form noValidate autoComplete="off">
        <TextField
          // hintText="Name"
          label="Name"
          fullWidth={true}
          margin="normal"
        />
         <TextField
          // hintText="Name"
          label="E-mail"
          fullWidth={true}
          margin="normal"
        />
        <TextField
          // hintText="Name"
          label="Documento"
          fullWidth={true}
          margin="normal"
        >
          {/* <InputMask mask="(0)999 999 99 99" maskChar=" " /> */}
        </TextField>
        <FormControl>
          <MuiPickersUtilsProvider utils={DateFnsUtils}>
            <KeyboardDatePicker
              disableToolbar
              variant="inline"
              format="dd/MM/yyyy"
              margin="normal"
              id="date-picker-inline"
              label="Data de Nascimento"
              value={selectedDate}
              onChange={handleDateChange}
              KeyboardButtonProps={{
                'aria-label': 'change date',
              }}
            />
          </MuiPickersUtilsProvider>
        </FormControl>

        <div style={styles.toggleDiv}>
          <FormControlLabel control={<Switch />} label="Disabled" />
        </div>
        <Divider />

        <div style={styles.buttons}>
          <Link to="/">
            <Button variant="contained">Cancel</Button>
          </Link>

          <Button
            style={styles.saveButton}
            variant="contained"
            type="submit"
            color="primary"
          >
            Save
          </Button>
        </div>
      </form>
    </PageBase>
  );
};

export default FormPage;
