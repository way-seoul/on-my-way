
const searchForm = document.getElementById('search_form');
const searchInput = document.getElementById('search');
const clearBtn = document.getElementById('clear');
const resultsContainer = document.querySelectorAll('div#challenges > details');

clearBtn.addEventListener('click', () => {
    showAllResults();
    searchForm.reset();
})

//Collect user input and call function to filter input..
searchInput.addEventListener("input", (e) => {
    let searchVal = e.target.value;
    if(searchVal.length > 0) {
        filterResults(searchVal)
    } else {
        showAllResults();
    }
});

const filterResults = (searchVal) => {
    searchVal = searchVal.trim().toLowerCase();
    for(let i=0; i<resultsContainer.length; i++) {
        let place = resultsContainer[i];
        let placeNameTxt = resultsContainer[i].firstElementChild.textContent.toLowerCase();
        if(placeNameTxt.indexOf(searchVal) > -1) {
            place.style.display = 'block';
            //PLACE NAME FOUND SO ALL CHALLENGES ASSOCIATED WITH THAT PLACE SHOULD BE DISPLAYED
            showAllChallenges(place);
        } else {
            if(filterChallenges(place, searchVal)) {
                place.style.display = 'block';
            } else {
                place.style.display = 'none';
            } 
        }
    }
} 

const showAllResults = () => {
    //Loop places
    for(let i=0; i<resultsContainer.length; i++) {
        let place = resultsContainer[i];
        place.style.display = 'block';
        //Show challenges for given place
        showAllChallenges(place);
    }
}

const showAllChallenges = (place) => {
    let challenges = place.lastElementChild.querySelectorAll('li');
    for(let i=0; i<challenges.length; i++) {
        let challenge = challenges[i];
        challenge.style.display = 'block';
    }
}

const filterChallenges = (place, searchVal) => {
    let challengeFound;
    let challenges = place.lastElementChild.querySelectorAll('li');
    for(let i=0; i<challenges.length; i++) {
        let challenge = challenges[i];
        let challengeNameTxt = challenges[i].querySelector('a').textContent.toLowerCase();
        if(challengeNameTxt.indexOf(searchVal) > -1) {
            challengeFound = true;
            challenge.style.display = 'block';
        } else {
            challenge.style.display = 'none';
        }
    }
    //Will be null if no matches were found..
    return challengeFound;
}
    
