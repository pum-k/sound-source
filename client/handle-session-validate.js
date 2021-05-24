const getValidate = (key) => {
  return sessionStorage.getItem(key);
};

const setValidate = (key, value) => {
  sessionStorage.setItem(key, value);
};

const deleteValidate = (key) => {
  sessionStorage.removeItem(key);
};
