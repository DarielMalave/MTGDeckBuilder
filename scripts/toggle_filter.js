// This function is going to manipulate the current page's URL based on if user
// clicks on the filter buttons at the top of the search page.
// If the clicked filter is already present in URL, clicking the filter is going
// to remove the filter from URL.
// If the clicked filter is not present in URL, clicking the filter is going to 
// add the filter to the URL.
// This function will effectively act as a "toggle" function for search queries.
// This function is also going to clean up the URL after manipulation to make sure
// it looks neat and follows the pattern of "...?filter=value&filter=value&filter=value..."
function toggle_filter(filter) {
    // grab URL of page
    let string_url = window.location.href;
    // declare empty variable to hold new string_url and used as a
    // placeholder when manipulating string_url
    let updated_string_url;

    // if there are no filters in URL, that means that all filter buttons are not
    // toggled on and by default the search page is going to reveal all cards from
    // all sets
    // to apply filters, let's add a question mark at the end
    if (string_url.indexOf("?") === -1) {
        string_url += "?";
    }

    // if filter does exist in string_url, remove filter from URL
    if (string_url.indexOf(filter) > -1) {
        updated_string_url = string_url.replace(filter, "");
    }
    // otherwise, filter does not exist in string_url
    else {
        updated_string_url = string_url.concat("&" + filter);
    }

    // in case if after removal and & is the last character, remove the last &
    // (happens if last filter is removed)
    if (updated_string_url.substring(updated_string_url.length - 1) === "&") {
        updated_string_url = updated_string_url.substring(0, updated_string_url.length - 1);
    }

    if (updated_string_url.substring(updated_string_url.length - 1) === "?") {
        updated_string_url = updated_string_url.substring(0, updated_string_url.length - 1);
    }

    // fix symbols in case if ?& ever appears (happens when removing first filter)
    updated_string_url = updated_string_url.replace("?&", "?");
    // sometimes double & appear in URL, change to single &
    updated_string_url = updated_string_url.replace("&&", "&");

    // set current URL to new URL after string manipulation
    window.location.assign(updated_string_url);
}