import * as React from 'react';
import Radio from '@mui/material/Radio';
import RadioGroup from '@mui/material/RadioGroup';
import FormControlLabel from '@mui/material/FormControlLabel';
import FormControl from '@mui/material/FormControl';
import FormLabel from '@mui/material/FormLabel';

const FormRadio = (props) => {
  return (
    <FormControl>
      <FormLabel id="demo-radio-buttons-group-label">{props.label}</FormLabel>
      <RadioGroup
        aria-labelledby="demo-radio-buttons-group-label"
        defaultValue="boleto"
        name="radio-buttons-group"
        onChange={props.onChange}
        row={props.row}
      >
        {props.options.map((item) => {
          return <FormControlLabel value={item.id} key={item.id} control={<Radio />} label={item.name}/>
        })}
      </RadioGroup>
    </FormControl>
  );
}

export default FormRadio;