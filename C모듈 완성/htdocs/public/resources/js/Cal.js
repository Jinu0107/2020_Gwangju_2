window.addEventListener("load", () => {
    let cal = new Cal();
    $("#test").datepicker();
});


class Cal {
    constructor() {
        this.init();
        this.$tbody = $(".myTbody");
        this.$date = $(".date");

    }

    get copy() {
        return $("#test table tbody").html();
    }

    get date(){
        return $("#test > div > div > div").html();
    }

    init() {
        setTimeout(() => {
            this.html = $("#test table tbody").html();
            this.$tbody.html(this.html);
            this.$tbody.find("td").addClass("center_td");
            this.$date.html($("#test > div > div > div").html());
            this.setEvent();
        }, 1);

    }

    setEvent() {
        $(".next").on("click", () => {
            document.querySelector("#test > div > div > a.ui-datepicker-next.ui-corner-all").click();
            this.$tbody.html(this.copy);
            this.$date.html(this.date);
            this.$tbody.find("td").addClass("center_td");
        });

        $(".prev").on("click", () => {
            document.querySelector("#test > div > div > a.ui-datepicker-prev.ui-corner-all").click();
            this.$tbody.html(this.copy);
            this.$date.html(this.date);
            this.$tbody.find("td").addClass("center_td");
        });

        $(".now").on("click", () => {
            this.$tbody.html(this.html);
            this.$date.html(this.date);
            this.$tbody.find("td").addClass("center_td");
        });

    }
}