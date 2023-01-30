import Repository from "./Repository";
const resource = "/categories";

export default {
    get(params = {}) {
        return Repository.get(`${resource}`, { params });
    }
};
