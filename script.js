function filter(page) {

    if (page == undefined) page = 1;
    var req = new XMLHttpRequest();
    filter_type = document.querySelector('input[name="filer_param"]:checked').value;
    par = 'filter_type=' + filter_type + '&page=' + page;

    req.onreadystatechange = function () {
        if (this.readyState == 4)
            if (this.status == 200)
                if (this.responseText != null) {
                    if (this.responseText != "404") {
                        document.getElementById('table').innerHTML = this.responseText;
                    }

                }


    }

    req.open("POST", "GetData.php", true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send(par);

}

function ready() {
    filter(1);
}