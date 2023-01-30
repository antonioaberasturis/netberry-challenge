import Repository from "./Repository";
const resource = "/tasks";

export default {
    get(params = {}) {
        return Repository.get(`${resource}`, { params });
    },
    post(params = {}) {
        return Repository.post(`${resource}`, params);
    },
    delete(id) {
        return Repository.delete(`${resource}/${id}`);
    }
};