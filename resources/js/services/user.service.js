import axios from 'axios';
import authHeader from './auth-header';

let baseURL = import.meta.env.VITE_AXIOS_BASE_URL;
if(baseURL) { baseURL = baseURL + '/api/' }
else { baseURL = '/api/' }

const API_URL = baseURL + 'test/';

class UserService {
  getPublicContent() {
    return axios.get(API_URL + 'all');
  }

  getUserBoard() {
    return axios.get(API_URL + 'user', { headers: authHeader() });
  }

  getModeratorBoard() {
    return axios.get(API_URL + 'mod', { headers: authHeader() });
  }

  getAdminBoard() {
    return axios.get(API_URL + 'admin', { headers: authHeader() });
  }
}

export default new UserService();