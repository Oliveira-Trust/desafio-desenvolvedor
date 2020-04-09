export const initialUserState = JSON.parse(localStorage.getItem("user"));

export function userReducer(state = initialUserState, action) {
  // { type: 'LOGIN_USER', user }
  switch(action.type) {
  case "SAVE_USER_DATA":
    return action.user;
  default:
    return state;
  }
}

export default userReducer;