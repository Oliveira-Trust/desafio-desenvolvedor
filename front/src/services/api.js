import Axios from "axios"

const api = Axios.create({
    baseURL:"http://localhost:8004/api/"
})

export default api;