</td>

<td width="300px" class="sidebar">
    <div class="sidebarHeader">Меню</div>
    <ul>
        <li><a href="/">Главная страница</a></li>
        <?php if ($user !== null && $user->isAdmin()): ?>
            <li><a href="/admin">Админка</a></li>
        <?php endif; ?>
        <li><a href="/about-me">Обо мне</a></li>
    </ul>
</td>
</tr>

</table>
</main>
<footer class="footer">
    <div>
        <p>Лучшие новости</p>
    </div>
    <div class="preview">
        <figure>
            <p><img src="/../img/Frame.png" alt="картинка"></p>
            <figcaption>описание</figcaption>
        </figure>
        <figure>
            <p><img src="/../img/Frame2.png" alt="картинка"></p>
            <figcaption>описание</figcaption>
        </figure>
        <figure>
            <p><img src="/../img/Frame3.png" alt="картинка"></p>
            <figcaption>описание</figcaption>
        </figure>
    </div>
    <p>Все права защищены © <a href="">Халимон Сергей</a></p>
</footer>

</body>
</html>
