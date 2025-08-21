// AxiosHelper class encapsulating axios instance and related utilities
class AxiosHelper
{
	constructor(config = {})
    {
		this.axiosInstance = axios.create({
			baseURL: config.baseURL || '',
			headers: {
				'X-Requested-With': 'XMLHttpRequest',
				'Accept': 'application/json',
				'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
			},
			...config
		});

		this._setupInterceptors();
	}

	// Utility for button loading state
	setButtonLoadingState(isLoading)
    {
		document.querySelectorAll('button[type="submit"]').forEach(function (btn)
        {
			let contentWrapper = btn.querySelector('.btn-content-wrapper');
			if (!contentWrapper)
            {
				contentWrapper = document.createElement('span');
				contentWrapper.className = 'btn-content-wrapper d-flex align-items-center justify-content-center w-100';
				while (btn.firstChild)
                {
					contentWrapper.appendChild(btn.firstChild);
				}
				btn.appendChild(contentWrapper);
			}

			if (isLoading)
            {
				btn.disabled = true;
				btn.classList.add('waves-effect', 'waves-light', 'position-relative');
				contentWrapper.style.opacity = '0';
				if (!btn.querySelector('.btn-loading-spinner'))
                {
					const spinner = document.createElement('span');
					spinner.className = 'btn-loading-spinner spinner-border spinner-border-sm text-light position-absolute top-50 start-50 translate-middle';
					spinner.setAttribute('role', 'status');
					spinner.setAttribute('aria-hidden', 'true');
					btn.appendChild(spinner);
				}
			}
            else
            {
				btn.disabled = false;
				btn.classList.remove('position-relative');
				contentWrapper.style.opacity = '';
				const spinner = btn.querySelector('.btn-loading-spinner');
				if (spinner) spinner.remove();
			}
		});
	}

	// Setup axios interceptors
	_setupInterceptors()
    {
		this.axiosInstance.interceptors.request.use(
			(config) =>
            {
				this.setButtonLoadingState(true);
				return config;
			},
			(error) =>
            {
				this.setButtonLoadingState(false);
				console.error('Request error:', error);
				return Promise.reject(error);
			}
		);

		this.axiosInstance.interceptors.response.use(
			(response) =>
            {
				this.setButtonLoadingState(false);
				return response;
			},
			(error) =>
            {
				this.setButtonLoadingState(false);

				const notifyError = (msg) =>
                {
					if (typeof toasterAlert === 'function')
                    {
						toasterAlert('error', msg);
					}
                    else
                    {
						alert(msg);
					}
				};

				if (error.response)
                {
					let message = error.response.data?.message || 'An error occurred';
					if (Array.isArray(message))
                    {
						message.forEach(notifyError);
					}
                    else if (typeof message === 'object' && message !== null)
                    {
						Object.values(message).forEach(function (val)
                        {
							if (Array.isArray(val))
                            {
								val.forEach(notifyError);
							}
                            else
                            {
								notifyError(val);
							}
						});
					}
                    else
                    {
						notifyError(message);
					}
				}
                else if (error.request)
                    {
					notifyError('No response from server. Please check your connection.');
				}
                else
                {
					notifyError('Error: ' + error.message);
				}

				return Promise.reject(error);
			}
		);
	}

	/**
	 * API request wrapper using the axios instance.
	 * @param {Object} options - Axios request config (method, url, data, params, etc.)
	 * @returns {Promise<any>} - Resolves with response data or rejects with error
	 */
	apiRequest(options)
    {
		return this.axiosInstance(options)
        .then(response => response.data)
        .catch(error =>
        {
            // Error already handled globally, but you can add more logic here if needed
            throw error;
        });
	}
}

// Make a global instance for use in Blade and scripts
window.axiosHelper = new AxiosHelper();

// For convenience, you can call apiRequest directly in Blade scripts as:
//   axiosHelper.apiRequest({ url: '...', method: 'POST', data: {...} })
// Or access the axios instance as:
//   axiosHelper.axiosInstance
