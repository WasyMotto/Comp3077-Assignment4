<!-- build-card.php -->
<div class="build-card">
    <h3><?= htmlspecialchars($build['buildName']) ?></h3>
    <p><strong>Creator:</strong> <?= htmlspecialchars($build['username']) ?></p>
    <p><strong>Exotic Armor:</strong> <?= htmlspecialchars($build['exoticArmor']) ?></p>
    <p><?= nl2br(htmlspecialchars(substr($build['description'], 0, 100))) ?>...</p>
    <a href="../Builds/build.php?buildID=<?= $build['buildID'] ?>" class="button">View Full Build</a>
</div>
