import axios from 'axios';
const API = axios.create({ baseURL: 'http://localhost:8000/api', headers: {'X-API-KEY': localStorage.getItem('api_key')} });
export default API;