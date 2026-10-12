<div>

    <h1 class="mb-3 text-4xl font-bold">
        🎾 How Our Rating Works
    </h1>

    <p class="mb-10 text-lg text-gray-600">
        A simple explanation of how we calculate your padel rating.
    </p>

    <section class="mb-8 rounded-xl bg-white p-6 shadow-sm">
        <h2 class="mb-3 text-2xl font-semibold">1. Starting Rating</h2>
        <p>
            Every new player starts at
            <strong>1500 points</strong>.
            Your rating changes as you play games, reflecting
            your performance against other players.
        </p>
    </section>

    <section class="mb-8 rounded-xl bg-white p-6 shadow-sm">
        <h2 class="mb-3 text-2xl font-semibold">
            2. Expected Win Probability
        </h2>

        <p class="mb-4">
            We compare the combined ratings of both teams
            to estimate the probability of Team A winning.
        </p>

        <div class="rounded-lg bg-gray-100 p-4 font-mono text-sm">
            Expected score = 1 / (1 + 10<sup>(Team B rating − Team A rating) / 400</sup>)
        </div>

        <p class="mt-4 text-gray-600">
            The result is a probability between 0 and 1.
            For example, 0.70 means a 70% expected chance of winning.
        </p>
    </section>

    <section class="mb-8 rounded-xl bg-white p-6 shadow-sm">
        <h2 class="mb-3 text-2xl font-semibold">
            3. The 70% Rule
        </h2>

        <ul class="list-disc space-y-3 pl-6">
            <li>
                <strong>Expected win probability above 70%:</strong>
                winning gives no rating points.
            </li>
            <li>
                <strong>Expected win probability below 30%:</strong>
                losing causes no rating loss.
            </li>
            <li>
                <strong>Otherwise:</strong>
                the rating changes according to the result
                and score difference.
            </li>
        </ul>
    </section>

    <section class="mb-8 rounded-xl bg-white p-6 shadow-sm">
        <h2 class="mb-3 text-2xl font-semibold">
            4. Rating Change
        </h2>

        <p class="mb-4">
            The basic change uses a K-factor of 12:
        </p>

        <div class="mb-4 rounded-lg bg-gray-100 p-4 font-mono text-sm">
            Base change = 12 × (Actual result − Expected probability)
        </div>

        <p class="mb-3">
            The result is adjusted by the score difference:
        </p>

        <div class="rounded-lg bg-gray-100 p-4 font-mono text-sm">
            Score factor = |Score A − Score B| / (Score A + Score B)
            <br><br>
            Final change = round(Base change × (1 + Score factor))
        </div>
    </section>

    <section class="rounded-xl bg-white p-6 shadow-sm">
        <h2 class="mb-3 text-2xl font-semibold">
            5. Keep Improving!
        </h2>

        <p>
            Your rating reflects your results relative to expectations.
            Challenge stronger opponents, play more tournaments,
            and watch your progress over time. 💪
        </p>
    </section>
    <section class="mb-6"></siction>

</div>