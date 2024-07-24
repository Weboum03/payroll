import apiClient from "../composables/apiClient";

const API_PATH = 'auth/';

class AuthService {
  login(user) {
    return apiClient
      .post(API_PATH + 'login', {
        email: user.email,
        password: user.password
      })
      .then(response => {
        localStorage.setItem('auth_token', response.data?.access_token);
        return response.data;
      });
  }

  logout() {
    localStorage.removeItem('user');
    localStorage.removeItem('auth_token');
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