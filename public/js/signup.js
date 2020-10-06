
const signupForm = document.getElementById('signup_form');

signupForm.onsubmit = (event) => {
  event.preventDefault();

  let userFormData = new FormData(signupForm);

  let dataToSubmit = {};
  for (let data of userFormData.entries()) {
    dataToSubmit[data[0]] = data[1]
  }

  postData(API_URL + '/signup', dataToSubmit).then(response => {

    if (!response.success && response.code !== 200) {
      alert(response.message);
      return;
    }

    alert(response.message);
    location.href = ROOT_URL + '/admin/login'

  });

}