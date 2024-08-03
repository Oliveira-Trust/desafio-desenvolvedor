import { Button as MuiButton } from "@mui/material";

export default function Button(props) {
  return (
    <div>
      <MuiButton
        disabled={props.disabled ? props.disabled : false}
        onClick={props.onClick}
        variant={props.variant}
        type={props.type}
        disableRipple
        className={props.className}
        color={props.color}
        sx={props.sx}
      >
        {props.text ?? props.children}
      </MuiButton>
    </div>
  );
}
