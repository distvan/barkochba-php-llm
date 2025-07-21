# Setting up

You need to download a model after docker compose up
run for examle ollama pull llama3 inside the container

Frontend test: docker compose run --rm node npm run test

DB Migration related commands:

- docker compose run --rm dbmate status
- docker compose run --rm dbmate new <name>
- docker compose run --rm dbmate migrate
- docker compose run --rm dbmate rollback

## Interesting cultural background

According to a legend, during his reign, Bar Kohba was once presented a mutilated man, who had his tongue ripped out and hands cut off. Unable to talk or write, the victim was incapable of telling who his attackers were. Thus, Bar Kokhba decided to ask simple questions to which the dying man was able to nod or shake his head with his last movements;the murderers were conequently apprehended.

In Hungary, this legend spawned the "Bar Kokhba game", in which one of two players comes up with a word or object, while the other must figure it out by asking questions only to be answered with "yes" or "no". The questioner usually asks first if it is a living being, if not, if it is an object, if not, it is surely an abstraction. The verb kobarkochbazni ("to Bar Kochba out") became a common language verb meaning "retrieving information in an extremely tedious way."

source: https://en.wikipedia.org/wiki/Simon_bar_Kokhba
