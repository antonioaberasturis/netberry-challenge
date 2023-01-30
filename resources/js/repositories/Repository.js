import axios from "axios";

const baseURL = import.meta.env.VITE_APP_API_URL;
;

const http = axios.create({
    baseURL: baseURL
});

export default http;