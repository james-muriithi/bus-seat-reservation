const globalMixins = {
    methods: {
        formatNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        makeToast(type = "success", msg, title) {
            this.$toastr.Add({
                title,
                type,
                msg
            });
        },
        showSuccessToast(msg) {
            const title = "Hurray!",
                type = "success";
            this.makeToast(type, msg, title);
        },
        showErrorToast(msg) {
            const title = "Oops!",
                type = "error";
            this.makeToast(type, msg, title);
        }
    }
};

export default globalMixins;
