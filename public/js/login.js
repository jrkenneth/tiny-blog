

const loginForm = document.getElementById('login_form');

loginForm.onsubmit = (event) => {
  event.preventDefault();

  let userFormData = new FormData(loginForm);

  let dataToSubmit = {};
  for (let data of userFormData.entries()) {
    dataToSubmit[data[0]] = data[1]
  }


  postData(API_URL + '/login', dataToSubmit).then(response => {

    if (!response.success && response.code !== 200) {
      alert(response.message);
      return;
    }

    alert(response.message);
    location.href = ROOT_URL + '/admin/index'

  });

}