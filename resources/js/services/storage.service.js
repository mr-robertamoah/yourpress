const StorageService = {
    set({ item, value, stringify = false }) {
        if (stringify) {
            value = JSON.stringify(value);
        }

        localStorage.setItem(item, value);
    },
    get({ item, parse = false }) {
        let value = localStorage.getItem(item);

        if (parse) {
            return JSON.parse(value);
        }

        return value;
    },
    remove(item) {
        return localStorage.removeItem(item);
    },
    clear() {
        return localStorage.clear();
    },
};

export default StorageService;
