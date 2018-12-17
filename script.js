var field_names = {
    email: "email",
    first_name: "имя",
    last_name: "фамилию",
    pass_1: "пароль",
    pass_2: "повтор пароля"
};

var app = new Vue({
    el: "#js-app",
    data: {
        form: {
            email: "",
            first_name: "",
            last_name: "",
            pass_1: "",
            pass_2: ""
        },
        is_email_valid: false,
        is_error_visible: false,
        error_message: "",
        registered: false,
        register_message: "",
        checked_mail: ""
    },
    methods: {
        setError: function (message) {
            this.is_error_visible = true;
            this.error_message = message;
        },

        clearError: function () {
            this.is_error_visible = false;
        },

        validateForm: function () {
            this.clearError();
            if (this.form.pass_1 != "") {
                if (this.form.pass_1 != this.form.pass_2) {
                    this.setError('Введённые пароли не совпадают');
                    return false
                }
            }

            for (let key in this.form) {
                if (!this.form.hasOwnProperty(key)) {
                    continue;
                }
                if (this.form[key] == "") {
                    this.setError(`Необходимо заполнить ${field_names[key]}`);
                    return false;
                }
            }

            if (this.is_error_visible) {
                return false;
            }
            return true;
        },

        checkUserExists: function () {
            if (this.form.email != "" && this.form.email != this.checked_mail) {
                return $.post(
                    "/ajax.php?only_check=1",
                    {"email": this.form.email},
                    undefined,
                    "json"
                ).then((result) => {
                    this.checked_mail = this.form.email;
                    if (result.error) {
                        this.setError(result.error);
                        this.is_email_valid = false;
                        return false;
                    } else {
                        this.clearError();
                        this.is_email_valid = true;
                        return true;
                    }
                });
            }
        },

        submit: function () {
            if (!this.validateForm() || !this.is_email_valid) {
                return;
            }
            $.post(
                "/ajax.php",
                {
                    "email": this.form.email,
                    "first_name": this.form.first_name,
                    "last_name": this.form.last_name,
                    "pass_1": this.form.pass_1,
                    "pass_2": this.form.pass_2,
                },
                undefined,
                "json"
            ).then((result) => {
                if (result.error) {
                    this.setError(result.error);
                } else {
                    this.registered = true;
                    this.register_message = result.message;
                }
            });
        },
    }
});