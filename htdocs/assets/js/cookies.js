if (Cookies.get("title") === undefined || Cookies.get("footer") === undefined) {
  let url =
    "https://api.github.com/repos/javascript-tutorial/en.javascript.info/commits";
  let response = await fetch(url);

  let commits = await response.json(); // read response body and parse as JSON

  alert(commits[0].author.login);
}
