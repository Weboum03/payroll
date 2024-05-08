import apiClient from "../composables/api-client";

const API_PATH = 'admin/auth/';

class AuthService {
  login(user) {
    return apiClient
      .post(API_PATH + 'login', {
        email: user.email,
        password: user.password
      })
      .then(response => {
        if (response.data.accessToken) {
          localStorage.setItem('user', JSON.stringify(response.data));
        }

        return response.data;
      });
  }

  logout() {
    localStorage.removeItem('user');
  }

  register(user) {
    return apiClient.post(API_PATH + 'register', {
      username: user.username,
      email: user.email,
      password: user.password
    });
  }

  getUser() {
    return apiClient.get(API_PATH + 'user')
    .then(response => {
      return response.data;
    });;
  }
}

export default new AuthService();