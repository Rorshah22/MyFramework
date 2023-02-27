</td>

<td width="300px" class="sidebar">
    <div class="sidebarHeader">Меню</div>
    <ul>
        <li><a href="/">Главная страница</a></li>
        <?php if ($user !== null && $user->isAdmin()):?>
        <li><a href="/admin">Админка</a></li>
        <?php endif;?>
        <li><a href="/about-me">Обо мне</a></li>
    </ul>
</td>
</tr>
<tr>
    <td class="footer" colspan="2">Все права защищены (c) Мой блог</td>
</tr>
</table>

</body>
</html>
