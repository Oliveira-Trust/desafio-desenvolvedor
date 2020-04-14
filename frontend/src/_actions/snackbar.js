export const showSnackbar = message => {
  return { type: "SNACKBAR_SHOW", message };
};
  
export const clearSnackbar = () => {
  return { type: "SNACKBAR_CLEAR" };
};