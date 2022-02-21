import axios, { AxiosError, AxiosPromise, AxiosRequestConfig } from "axios";
const API_URL = process.env.REACT_APP_API_URL;
const API_PREFIX = "api/";

const serverErrorCodes = [
  500, 501, 502, 503, 504, 505, 506, 507, 508, 510, 511,
];

axios.interceptors.response.use(
  (response) => response,
  (error: AxiosError) => {
    const isNetworkError = !error.response;

    if (isNetworkError) {
      console.log("Network error");
    } else {
      const responseStatusCode = error.response!.status;
      const isServerError = serverErrorCodes.includes(responseStatusCode);
      console.log("Network ok", isServerError);
    }

    return Promise.reject(error);
  }
);

const getConfig = (): AxiosRequestConfig => ({
  headers: {
    "Content-Type": "application/json",
  },
  responseType: "json",
});

export const ApiService = {
  get(path: string, prefix: string = API_PREFIX): AxiosPromise {
    const url = API_URL + prefix + path;
    return axios.get(url, { ...getConfig() });
  },

  post(path: string, data: {}, prefix: string = API_PREFIX): AxiosPromise {
    const url = API_URL + prefix + path;

    return axios.post(url, data, getConfig());
  },

  put(path: string, data: {}, prefix: string = API_PREFIX): AxiosPromise {
    const url = API_URL + prefix + path;

    return axios.put(url, data, getConfig());
  },

  delete(path: string, prefix: string = API_PREFIX): AxiosPromise {
    const url = API_URL + prefix + path;

    return axios.delete(url, getConfig());
  },
};
