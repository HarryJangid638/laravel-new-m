document.addEventListener("DOMContentLoaded", function () {
    // Get forms and elements safely
    let formAccountSettings = document.querySelector("#formAccountSettings");
    let formAccountDeactivation = document.querySelector("#formAccountDeactivation");
    let deactivateAccountBtn = formAccountDeactivation ? formAccountDeactivation.querySelector(".deactivate-account") : null;
    let tagifyCountry = document.querySelector("#TagifyCountrySuggestion");
    let tagifyLanguage = document.querySelector("#TagifyLanguageSuggestion");

    // Tagify initializations (only if elements exist)
    if (tagifyCountry) {
        new Tagify(tagifyCountry, {
            whitelist: [
                "Australia", "Bangladesh", "Belarus", "Brazil", "Canada", "China", "France", "Germany", "India", "Indonesia", "Israel", "Italy", "Japan", "Korea", "Mexico", "Philippines", "Russian Federation", "South Africa", "Thailand", "Turkey", "Ukraine", "United Arab Emirates", "United Kingdom", "United States"
            ],
            maxTags: 20,
            dropdown: {
                maxItems: 20,
                classname: "",
                enabled: 0,
                closeOnSelect: false
            }
        });
    }
    if (tagifyLanguage) {
        new Tagify(tagifyLanguage, {
            whitelist: ["Portuguese", "German", "French", "English"],
            dropdown: {
                classname: "",
                enabled: 0,
                closeOnSelect: false
            }
        });
    }

    // FormValidation for Account Settings
    if (formAccountSettings && typeof FormValidation !== "undefined") {
        FormValidation.formValidation(formAccountSettings, {
            fields: {
                firstName: {
                    validators: {
                        notEmpty: {
                            message: "Please enter first name"
                        }
                    }
                },
                lastName: {
                    validators: {
                        notEmpty: {
                            message: "Please enter last name"
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: "",
                    rowSelector: ".form-control-validation"
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                autoFocus: new FormValidation.plugins.AutoFocus()
            },
            init: (fv) => {
                fv.on("plugins.message.placed", function (e) {
                    if (e.element.parentElement.classList.contains("input-group")) {
                        e.element.parentElement.insertAdjacentElement("afterend", e.messageElement);
                    }
                });
            }
        });
    }

    // FormValidation for Account Deactivation
    if (formAccountDeactivation && typeof FormValidation !== "undefined") {
        FormValidation.formValidation(formAccountDeactivation, {
            fields: {
                accountActivation: {
                    validators: {
                        notEmpty: {
                            message: "Please confirm you want to delete account"
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: ""
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                fieldStatus: new FormValidation.plugins.FieldStatus({
                    onStatusChanged: function (isValid) {
                        if (deactivateAccountBtn) {
                            if (isValid) {
                                deactivateAccountBtn.removeAttribute("disabled");
                            } else {
                                deactivateAccountBtn.setAttribute("disabled", "disabled");
                            }
                        }
                    }
                }),
                autoFocus: new FormValidation.plugins.AutoFocus()
            },
            init: (fv) => {
                fv.on("plugins.message.placed", function (e) {
                    if (e.element.parentElement.classList.contains("input-group")) {
                        e.element.parentElement.insertAdjacentElement("afterend", e.messageElement);
                    }
                });
            }
        });
    }

    // Deactivate account confirmation
    let accountActivationCheckbox = document.querySelector("#accountActivation");
    if (deactivateAccountBtn && accountActivationCheckbox) {
        deactivateAccountBtn.onclick = function () {
            if (accountActivationCheckbox.checked) {
                Swal.fire({
                    text: "Are you sure you would like to deactivate your account?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    customClass: {
                        confirmButton: "btn btn-primary me-2 waves-effect waves-light",
                        cancelButton: "btn btn-outline-secondary waves-effect"
                    },
                    buttonsStyling: false
                }).then(function (result) {
                    if (result.value) {
                        Swal.fire({
                            icon: "success",
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            customClass: {
                                confirmButton: "btn btn-success waves-effect"
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                            title: "Cancelled",
                            text: "Deactivation Cancelled!!",
                            icon: "error",
                            customClass: {
                                confirmButton: "btn btn-success waves-effect"
                            }
                        });
                    }
                });
            }
        };
    }

    // Phone number formatting
    let phoneNumberInput = document.querySelector("#phoneNumber");
    if (phoneNumberInput) {
        phoneNumberInput.addEventListener("input", (e) => {
            let val = e.target.value.replace(/\D/g, "");
            phoneNumberInput.value = formatGeneral(val, {
                blocks: [3, 3, 4],
                delimiters: [" ", " "]
            });
        });
        if (typeof registerCursorTracker === "function") {
            registerCursorTracker({
                input: phoneNumberInput,
                delimiter: " "
            });
        }
    }

    // Zip code formatting
    let zipCodeInput = document.querySelector("#zipCode");
    if (zipCodeInput) {
        zipCodeInput.addEventListener("input", (e) => {
            zipCodeInput.value = formatNumeral(e.target.value, {
                delimiter: "",
                numeral: true
            });
        });
    }

    // Avatar upload and reset
    let uploadedAvatar = document.getElementById("uploadedAvatar");
    let accountFileInput = document.querySelector(".account-file-input");
    let accountImageReset = document.querySelector(".account-image-reset");
    if (uploadedAvatar && accountFileInput && accountImageReset) {
        let originalSrc = uploadedAvatar.src;
        accountFileInput.onchange = () => {
            if (accountFileInput.files[0]) {
                uploadedAvatar.src = window.URL.createObjectURL(accountFileInput.files[0]);
            }
        };
        accountImageReset.onclick = () => {
            accountFileInput.value = "";
            uploadedAvatar.src = originalSrc;
        };
    }
});

$(function () {
    var $select2 = $(".select2");
    if ($select2.length) {
        $select2.each(function () {
            var $el = $(this);
            if (typeof select2Focus === "function") {
                select2Focus($el);
            }
            $el.select2({
                dropdownParent: $el.parent()
            });
        });
    }
});