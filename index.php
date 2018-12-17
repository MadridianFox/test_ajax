<!DOCTYPE html>
<html>
    <head>
        <title>Регистрация</title>
        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="node_modules/vue/dist/vue.min.js"></script>
    </head>
    <body>
        <div id="js-app" class="container">
            <div class="row justify-content-center">
                <div class="col-4 align-self-center mt-5 ">
                    <div class="card" v-if="!registered">
                        <div class="card-header">
                            Регистрация
                        </div>
                        <div class="card-body">
                            <div class="alert alert-danger" v-if="is_error_visible">
                                {{ error_message }}
                            </div>
                            <div class="form-group">
                                <label for="js-email" class="control-label">Email<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="js-email" v-model="form.email" v-on:blur="checkUserExists">
                            </div>
                            <div class="form-group">
                                <label for="js-first-name" class="control-label">Имя<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="js-first-name" v-model="form.first_name" :disabled="!is_email_valid">
                            </div>
                            <div class="form-group">
                                <label for="js-last-name" class="control-label">Фамилия<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="js-last-name" v-model="form.last_name" :disabled="!is_email_valid">
                            </div>
                            <div class="form-group">
                                <label for="js-pass-1" class="control-label">Пароль<span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="js-pass-1" v-model="form.pass_1" :disabled="!is_email_valid">
                            </div>
                            <div class="form-group">
                                <label for="js-pass-2" class="control-label">Повтор пароля<span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="js-pass-2" v-model="form.pass_2" v-on:blur="validateForm" :disabled="!is_email_valid">
                            </div>
                            <button class="btn btn-primary mt-3 mb-3" v-on:click="submit" :disabled="!is_email_valid">Отправить</button>
                        </div>
                    </div>
                    <div class="card" v-else>
                        <div class="card-body">
                            {{ register_message }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="script.js"></script>
    </body>
</html>