let badge = document.querySelector(".tongsp");
let tongSp = () => {
    fetch("/totalProductsInCart")
        .then((res) => res.json())
        .then((data) => (badge.innerHTML = data))
        .catch((e) => console.error(e));
};
tongSp()

let sp = document.querySelectorAll(".auProduct");
let add = sp.forEach((btn) => {
    btn.addEventListener("click", (event) => {
        event.preventDefault();

        let idpv = btn.dataset.idv;
        let sl = btn.dataset.sl;

        axios
            .post("/add-cart", {
                idpv: idpv,
                sl: sl,
            })
            // .then(function (response) {
            //     console.log(response.data)
            // })
            .then(function (response) {
                if (response.data.err) {
                    
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "error",
                        title: response.data.mess,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                } else {
                    tongSp();
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "success",
                        title: response.data.mess,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            })
            .catch(function (error) {
                // Xử lý lỗi nếu có
                console.error("Có lỗi xảy ra:", error);
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    icon: "error",
                    title: "Lỗi kết nối!",
                    showConfirmButton: false,
                    timer: 1500,
                });
            });
    });
});
