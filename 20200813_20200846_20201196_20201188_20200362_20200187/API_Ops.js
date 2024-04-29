// API_Ops.js

class API_Ops {
    constructor(apiUrl, apiKey) {
        this.api_url = apiUrl;
        this.api_key = apiKey;
    }

    getActorsByBirthdate(birthdate) {
        const url = `${this.api_url}?date=${birthdate}`;
        const headers = {
            'x-rapidapi-host': 'imdb188.p.rapidapi.com',
            'x-rapidapi-key': this.api_key
        };

        return fetch(url, {
            method: 'GET',
            headers: headers
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.status) {
                    return data.data.list.map(actor => ({
                        id: actor.id,
                        name: actor.nameText.text
                    }));
                } else {
                    throw new Error(data.message);
                }
            })
            .catch(error => {
                throw new Error('Error fetching actors: ' + error.message);
            });
    }

}

// Export an instance of the API_Ops class
const apiOps = new API_Ops('https://imdb188.p.rapidapi.com/api/v1/getBornOn', '1486375ec8msh2ab7a4f4705777ap1748bajsn3ee2342f29e6');
export default apiOps;
