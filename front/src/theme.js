import createMuiTheme from "@material-ui/core/styles/createMuiTheme";
import { blue, grey, pink, red, deepOrange, orange, teal, green, amber, lime, deepPurple } from "@material-ui/core/colors";

export const availableThemes = [
  {
    title: "Default",
    primary: blue,
    secondary: grey
  },
  {
    title: "Sunset",
    primary: deepOrange,
    secondary: orange
  },
  {
    title: "Greeny",
    primary: teal,
    secondary: green
  },
  {
    title: "Beach",
    primary: pink,
    secondary: amber
  },
  {
    title: "Tech",
    primary: blue,
    secondary: lime
  },
  {
    title: "Deep Ocean",
    primary: deepPurple,
    secondary: pink
  }
];

const defaultTheme = {
  palette: {
    primary: blue,
    secondary: grey
  },
  error: red,
  appBar: {
    height: 57,
    color: blue[600]
  },
  drawer: {
    width: 240,
    color: grey[900],
    backgroundColor: grey[900],
    miniWidth: 56
  },
  raisedButton: {
    primaryColor: blue[600]
  },
  typography: {
    // useNextVariants: true
  }
};

const theme = createMuiTheme(defaultTheme);

export const customTheme = option => {
  return createMuiTheme({ ...defaultTheme, ...option });
};

export default theme;
