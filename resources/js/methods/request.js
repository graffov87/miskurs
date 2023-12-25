
class GraphQl {

    async getData(query) {
        const endpoint = "/graphql";
        const headers = {
            "content-type": "application/json",
            'X-CSRF-TOKEN': window.Laravel.csrfToken
        };
    
        const options = {
            "method": "POST",
            "headers": headers,
            "body": JSON.stringify(query)
        };

        const response = await fetch(endpoint, options);
        return await response.json();

    }
}

export default GraphQl;