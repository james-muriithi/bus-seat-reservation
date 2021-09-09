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
        },
        asset(path) {
            var base_path = window._asset || '';
            return base_path + path;
        },
        addPdfFooters(doc) {
            const pageCount = doc.internal.getNumberOfPages()

            const y = doc.internal.pageSize.height - 10;

            const x1 = doc.internal.pageSize.width / 2;
            const x2 = doc.internal.pageSize.width - 90;

            doc.setFont('helvetica', 'italic')
            doc.setFontSize(8)
            for (var i = 1; i <= pageCount; i++) {
                doc.setPage(i)
                doc.text('Page ' + String(i) + ' of ' + String(pageCount), x1, y);
                doc.text(moment().format('YYYY-MM-DD HH:mm:ss'), x2, y);
            }
        }
    }
};

export default globalMixins;