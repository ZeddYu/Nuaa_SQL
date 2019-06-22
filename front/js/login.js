document.querySelector('.img__btn').addEventListener('click', function () {
  document.querySelector('.cont').classList.toggle('s--signup');
});

const config = {
  headers: {
    'Content-Type': 'application/x-www-form-urlencoded'
  }
}


new Vue({
  el: '#login_box',
  data: {
    username: null,
    password: null,
  },
  methods: {
    login: function () {
      const params = new URLSearchParams();
      params.append('username', this.username);
      params.append('password', this.password);
      axios.post("http://zedd.cc/?s=User.Login", params, config)
        .then(response => {
          console.log(response);
          if (response.data.ret != 200) {
            alert(response.data.msg);
          }
          else if (response.data.ret == 200) {
            if (response.data.data['is_login'] === true && response.data.data['role'] === '1') {
              // console.log(response.data.data['role'] === '1');
              window.location = "http://zedd.cc/front/admin.php";
              // console.log(1);
            }
            else if (response.data.data['is_login'] === true && response.data.data['role'] === '2') {
              window.location = "http://zedd.cc/front/index.php";
            }
            else if (response.data.data['is_login'] === false) {
              alert(response.data.data['err_res']);
            }
          }
        })
    }
  }
})

new Vue({
  el: '#register_box',
  data: {
    username: null,
    password: null,
    en_password: null
  },
  headers: {
    'content-type': 'application/x-www-form-urlencoded;charset=utf-8'
  },
  methods: {
    register: function () {
      if (this.en_password !== this.password) {
        alert("Inconsistent input password twice!");
        return;
      }
      const params = new URLSearchParams();
      params.append('username', this.username);
      params.append('password', this.password);
      axios.post("http://zedd.cc/?s=User.Register", params, config)
        .then(response => {
          // console.log(response);
          if (response.data.ret != 200) {
            alert(response.data.msg);
          }
          else if (response.data.ret == 200) {
            if (response.data.data['register_status'] === true) {
              alert("Register Success!");
            }
            else if (response.data.data['register_status'] !== true) {
              alert(response.data.data['err_res']);
            }
          }
        })
    }
  }
})

// function login() {
//   $.ajax({
//     url: "http://zedd.cc/?s=User.Logout&id=1",
//     type: "GET",
//     headers: {
//       'Access-Control-Allow-Origin': '*',
//       "Access-Control-Allow-Methods": "GET,HEAD,OPTIONS,POST,PUT",
//       // "Access-Control-Allow-Headers": "Origin, X-Requested-With, Content-Type, Accept, Authorization"
//     },
//     success: function (data) {
//       alert(data);
//     }
//   });
// }
