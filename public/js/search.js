(() => {
    const Search = {
        onReady: () => {
            console.log("init");

            $(document).on("click", "#btnSearch", function (e) {
                Search.onRefreshList();
            });

            $(document).on("keypress", "#textSearch", function (e) {
                if (e.key === "Enter") {
                    // Cancel the default action, if needed
                    e.preventDefault();
                    // Trigger the button element with a click
                    Search.onRefreshList();
                }
            });
        },

        onProcess: async (route, metodo = "get", params = {}) => {
            let options = {
                type: metodo,
                url: route,
                data: params,
                dataType: metodo == "get" ? "html" : "json",
            };

            return $.ajax(options);
        },

        onRefreshList: async (params = {}) => {
            const route = $("#btnSearch").attr("data-route");
            let query = {
                search: $("#textSearch").val(),
            };

            params = Object.keys(params).length == 0 ? query : params;

            Search.onProcess(route, "get", params).then((response) => {
                $(".listVideos").html(response);
            });
        },
    };

    Search.onReady();
})();
