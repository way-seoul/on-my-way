
const searchForm = document.getElementById('search_form');
const searchInput = document.getElementById('search');
const clearBtn = document.getElementById('clear');
const resultsContainer = document.querySelectorAll('div#challenges > form > details');


//BASIC FILTERING LOGIC BASED ON USER SUPPLIED SEARCH VAL FOR EACH PLACE!..
//1) IF PLACE FOUND, ALL CHALLENGES ASSOCIATED WITH THAT PLACE WILL BE RETURNED BY DEFAULT.
//2) IF PLACE NOT FOUND, CHECK EACH CHALLENGE INDIVIDUALLY 
//3) IF ANY CHALLENGES ARE FOUND, SHOW PLACE ALONG WITH ALL CHALLENGES WHICH WERE FOUND
//4_ IF NO CHALLENGES WERE FOUND HIDE THE PLACE!


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
        console.log(searchVal, '    ', placeNameTxt);
        if(placeNameTxt.indexOf(searchVal) > -1) {
            place.style.display = 'block';
            //PLACE NAME FOUND SO ALL CHALLENGES ASSOCIATED WITH THAT PLACE SHOULD BE DISPLAYED
            showAllChallenges(place);
        } else {
            let matchingChallenge = filterChallenges(place, searchVal);
            if(!matchingChallenge) place.style.display = 'none';
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
    
