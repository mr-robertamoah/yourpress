import axios from "axios";
import cookie from "js-cookie";
import { AppConstants } from "../app";
import router from "../routes";
import StorageService from "./storage.service";

const ApiService = {
    redirectableStatusCode: [401, 419],
    mountResponseInterceptor() {
        return axios.interceptors.response.use(
            (response) => response,
            (error) => {
                console.log(error.response);
                if (
                    AppConstants.apiServices.nonRedirectables.includes(
                        router.currentRoute.name
                    )
                ) {
                    throw error;
                }

                if (
                    !redirectableStatusCode.includes(error.response?.status) &&
                    error.response?.config?.url !== "/user"
                ) {
                    throw error;
                }

                StorageService.remove("auth");

                router.push({
                    name: "login",
                    params: {
                        message: "Authentication failed. Please login 😏",
                    },
                });

                return error.response;
            }
        );
    },
    async get(url, config = null) {
        await this.getCSRFCookie(config);

        return axios.get(url, config);
    },
    async getCSRFCookie(config) {
        if (StorageService.get({ item: "auth", parse: true })) {
            return;
        }

        if (!config?.mustHaveCookie) {
            return;
        }

        return await this.get("/csrf-cookie");
    },
    async post(url, data, config = null) {
        await this.getCSRFCookie(config);

        return axios.post(url, data, config);
    },
};

export default ApiService;
