declare global {
    interface Window {
        apiRequest: (options: any) => Promise<any>;
        axiosInstance: any;
    }
}

export {};
