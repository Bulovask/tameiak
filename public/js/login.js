(() => {
    const loginForm = document.getElementById("login-form");
    const loginSubmit = document.getElementById("login-submit");

    async function login(func=()=>{}) {
        const res = await fetch(loginActionForm, {
            method: "POST",
            body: new FormData(loginForm)
        });
        
        if(res.ok) {
            const obj = await res.json();
            if(obj.err) {
                alert(obj.data);
            } else {
                func(obj.data);
            }
        } else {
            alert("houve um erro! Tente novamente");
        }
    }

    loginSubmit.addEventListener("click", () => {
        login(token => {
            loginForm.reset();
            setSection("add-user-section", token);
        });
    }, false);
})();