import * as React from 'react';
import Box from '@mui/material/Box';
import InputLabel from '@mui/material/InputLabel';
import MenuItem from '@mui/material/MenuItem';
import FormControl from '@mui/material/FormControl';
import Select from '@mui/material/Select';

const Dropdown = (props) => {
  const [age, setAge] = React.useState('');

  const handleChange = (event) => {
    setAge(event.target.value);
  };

  return (
    <Box sx={{ minWidth: 120 }}>
      <FormControl fullWidth>
        <InputLabel id="demo-simple-select-label" color="success">{props.label}</InputLabel>
        <Select
          labelId="demo-simple-select-label"
          id="demo-simple-select"
          color="success"
          value={props.value}
          label={props.label}
          onChange={props.handleChange}
        >
          <MenuItem value="EUR">Euro</MenuItem>
          <MenuItem value="USD">Dólar</MenuItem>
          <MenuItem value="BRL">Real</MenuItem>
        </Select>
      </FormControl>
    </Box>
  );
}

export default Dropdown;
